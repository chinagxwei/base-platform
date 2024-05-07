import { Component, OnInit } from '@angular/core';
import {Navigation} from "../../../models/system";
import {FormBuilder, FormGroup} from "@angular/forms";
import {AuthService} from "../../../services/system/auth.service";
import {NzMessageService} from "ng-zorro-antd/message";
import {Router} from "@angular/router";
import {PlatformLocation} from "@angular/common";
import {NzModalService} from "ng-zorro-antd/modal";
import {ManagerService} from "../../../services/system/manager.service";

@Component({
  selector: 'app-layout',
  templateUrl: './layout.component.html',
  styleUrls: ['./layout.component.css']
})
export class LayoutComponent implements OnInit {

  isCollapsed = false;

  username?: string;

  menuItems: Navigation[] = [];

  isVisible: boolean = false;

  passwordVisible: boolean = false;

  validateForm: FormGroup;

  constructor(
    private formBuilder: FormBuilder,
    private authService: AuthService,
    private message: NzMessageService,
    private router: Router,
    private platform: PlatformLocation,
    private modalService: NzModalService,
    private managerService: ManagerService,
  ) {
    this.validateForm = this.formBuilder.group({});
  }

  ngOnInit(): void {
    this.getLink();
    this.initNavigationSelect();
    this.managerService.info().subscribe(res => {
      // console.log(res)
      if (res.code === 200) {
        this.menuItems = res.data?.navigations ?? [];
        this.username = res.data?.nickname;
      }
    })

  }

  private initNavigationSelect() {
    const router = this.platform.pathname.substr(1);
    this.setMenuItem(router);
  }

  private setMenuItem(router: string) {
    // this.menuItems.map(value => value.select = (value.navigation_router === router));
  }

  private getLink() {
    // this.navigationService.all()
    //   .pipe(map(v => {
    //     v.data.map((v2, i) => i === 0 ? (v2.select = true) : (v2.select = false))
    //     return v;
    //   })).subscribe(res => {
    //   if (res.code === 0) {
    //     // @ts-ignore
    //     this.menuItems = res.data
    //   }
    // })

    // this.menuItems = this.authService.navigations;
  }

  onResetPassword() {

  }

  onLogout() {
    this.modalService.confirm({
      nzTitle: '登出提示',
      nzContent: '<b style="color: red;">点击登出后将会退出当前系统!</b>',
      nzOkText: '登出',
      nzCancelText: '取消',
      nzOnOk: () => {
        this.authService.logout();
      },
      nzOnCancel: () => {
        console.log('Cancel')
      }
    });
  }
}
