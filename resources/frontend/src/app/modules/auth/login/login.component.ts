import {Component, OnInit} from '@angular/core';
import {FormControl, FormGroup, NonNullableFormBuilder, Validators} from "@angular/forms";
import {AuthService} from "../../../services/system/auth.service";
import {tap} from "rxjs";
import {NzMessageService} from "ng-zorro-antd/message";

@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {
  validateForm: FormGroup<{
    username: FormControl<string>;
    password: FormControl<string>;
  }> = this.formBuilder.group({
    username: ['', [Validators.required]],
    password: ['', [Validators.required]],
  });

  isLoading = false;

  constructor(
    private formBuilder: NonNullableFormBuilder,
    private authService: AuthService,
    private nzMessageService: NzMessageService,
  ) {}

  ngOnInit(): void {
    if (this.authService.isLogin) {
      this.authService.toHome();
    }
  }

  submitForm(): void {
    this.isLoading = true;

    if (this.validateForm.valid) {
      const {username, password} = this.validateForm.controls;
      if (username?.value && password?.value) {
        console.log(this.validateForm.value)
        this.isLoading = true;
        this.authService
          .login(this.validateForm.value)
          .pipe(tap(() => (this.isLoading = false)))
          .subscribe(res => {
            if (!res.type) {
              this.nzMessageService.error(res.msg)
            }
          });
      }
    } else {
      this.isLoading = false;
      Object.values(this.validateForm.controls).forEach(control => {
        if (control.invalid) {
          control.markAsDirty();
          control.updateValueAndValidity({ onlySelf: true });
        }
      });
    }
  }
}
