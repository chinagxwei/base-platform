import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {NzModalService} from "ng-zorro-antd/modal";
import {NzMessageService} from "ng-zorro-antd/message";
import {EnterpriseRoutingModule} from "./enterprise-routing.module";
import { DashboardComponent } from './dashboard/dashboard.component';

@NgModule({
  declarations: [
    DashboardComponent
  ],
  imports: [
    CommonModule,
    EnterpriseRoutingModule,
  ],
  providers: [NzModalService, NzMessageService]
})
export class EnterpriseModule {
}
