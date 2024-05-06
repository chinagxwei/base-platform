import {Component, OnInit} from '@angular/core';
import {Paginate} from "../../../models/server-response";
import {RegisterRouter, SystemEnterprise, SystemRouter} from "../../../models/system";
import {FormBuilder, FormGroup, Validators} from "@angular/forms";
import {NzTableQueryParams} from "ng-zorro-antd/table";
import {tap} from "rxjs";
import {NzModalService} from "ng-zorro-antd/modal";
import {EnterpriseService} from "../../../services/system/enterprise.service";
import {ResponseCode} from "../../../utils/response-code";
import {NzMessageService} from "ng-zorro-antd/message";

@Component({
  selector: 'app-enterprise',
  templateUrl: './enterprise.component.html',
  styleUrls: ['./enterprise.component.css']
})
export class EnterpriseComponent implements OnInit {

  currentData: Paginate<SystemEnterprise> = new Paginate<SystemEnterprise>();

  loading = true;

  listOfData: SystemEnterprise[] = [];

  isVisible = false;

  validateForm: FormGroup;

  constructor(
    private formBuilder: FormBuilder,
    private message: NzMessageService,
    private modalService: NzModalService,
    private componentService: EnterpriseService
  ) {
    this.validateForm = this.formBuilder.group({});
  }

  ngOnInit(): void {

  }

  initForm() {
    this.validateForm = this.formBuilder.group({
      name: [null, [Validators.required]],
      name_en:[null]
    });
  }

  private getItems(page: number = 1) {
    this.loading = true;
    this.componentService.items(page)
      .pipe(tap(_ => this.loading = false))
      .subscribe(res => {
        const {data} = res;
        if (data) {
          this.currentData = data;
          this.listOfData = data.data;
        }
      })
  }

  add() {
    this.initForm();
    this.showModal();
  }

  update(data: SystemEnterprise) {
    this.validateForm = this.formBuilder.group({
      name: [data.name, [Validators.required]],
      name_en:[data.name_en]
    });
    this.showModal();
  }

  onDelete(id: any) {
    this.modalService.confirm({
      nzTitle: '删除提示',
      nzContent: '<b style="color: red;">是否删除该项数据!</b>',
      nzOkText: '确定',
      nzCancelText: '取消',
      nzOnOk: () => {

        this.componentService.delete(id).subscribe(res => {
          this.getItems(this.currentData.current_page);
        });
      },
      nzOnCancel: () => {
        console.log('Cancel')
      }
    });
  }

  onQueryParamsChange($event: NzTableQueryParams) {
    this.getItems($event.pageIndex);
  }

  showModal(): void {
    this.isVisible = true;
  }

  handleCancel() {
    this.isVisible = false;
  }

  handleOk() {
    if (this.validateForm.valid) {
      this.componentService.save(this.validateForm.value).subscribe(res => {
        console.log(res);
        if (res.code === ResponseCode.RESPONSE_SUCCESS) {
          this.message.success(res.message);
          this.handleCancel();
          this.validateForm.reset();
          this.getItems(this.currentData.current_page);
        }
      });
    } else {
      Object.values(this.validateForm.controls).forEach(control => {
        // @ts-ignore
        if (control.invalid) {
          // @ts-ignore
          control.markAsDirty();
          // @ts-ignore
          control.updateValueAndValidity({onlySelf: true});
        }
      });
    }
  }

}
