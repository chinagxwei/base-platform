import {NgModule} from '@angular/core';
import {CommonModule} from '@angular/common';
import {LogComponent} from './log/log.component';
import {NzTableModule} from "ng-zorro-antd/table";
import {UnitComponent} from './unit/unit.component';
import {UnitFormItemComponent} from './unit/unit-form-item/unit-form-item.component';
import {NzFormModule} from "ng-zorro-antd/form";
import {NzSelectModule} from "ng-zorro-antd/select";
import {NzIconModule} from "ng-zorro-antd/icon";
import {FormsModule, ReactiveFormsModule} from "@angular/forms";
import {NzButtonModule} from "ng-zorro-antd/button";
import {NzDividerModule} from "ng-zorro-antd/divider";
import {NzModalModule, NzModalService} from "ng-zorro-antd/modal";
import {NzInputModule} from "ng-zorro-antd/input";
import {RouterComponent} from './router/router.component';
import {RoleComponent} from './role/role.component';
import {NavigationComponent} from './navigation/navigation.component';
import {NzInputNumberModule} from "ng-zorro-antd/input-number";
import {NzTransferModule} from "ng-zorro-antd/transfer";
import {DragDropModule} from "@angular/cdk/drag-drop";
import {NzTagModule} from "ng-zorro-antd/tag";
import {ImageComponent} from './image/image.component';
import {DashboardComponent} from './dashboard/dashboard.component';
import {ConfigComponent} from './config/config.component';
import {LayoutComponent} from './layout/layout.component';
import {ComplaintComponent} from './complaint/complaint.component';
import {AgreementComponent} from './agreement/agreement.component';
import {EditorForAngularModule} from "wangeditor-for-angular";
import {NzSwitchModule} from "ng-zorro-antd/switch";
import {TagComponent} from './tag/tag.component';
import {NzLayoutModule} from "ng-zorro-antd/layout";
import {NzMenuModule} from "ng-zorro-antd/menu";
import {RouterLinkActive, RouterOutlet} from "@angular/router";
import {SystemRoutingModule} from "./system-routing.module";
import {ManagerComponent} from './manager/manager.component';
import {ManagerMessageComponent} from './manager/manager-message/manager-message.component';
import {MessageComponent} from './message/message.component';
import {NzMessageService} from "ng-zorro-antd/message";
import { ConfigRouterComponent } from './role/config-router/config-router.component';
import { ConfigNavigationComponent } from './role/config-navigation/config-navigation.component';
import {NzTreeModule} from "ng-zorro-antd/tree";


@NgModule({
  declarations: [
    LayoutComponent,
    LogComponent,
    UnitComponent,
    UnitFormItemComponent,
    RouterComponent,
    RoleComponent,
    NavigationComponent,
    ImageComponent,
    DashboardComponent,
    ConfigComponent,
    ComplaintComponent,
    AgreementComponent,
    TagComponent,
    ManagerComponent,
    ManagerMessageComponent,
    MessageComponent,
    ConfigRouterComponent,
    ConfigNavigationComponent
  ],
    imports: [
        CommonModule,
        SystemRoutingModule,
        NzTableModule,
        NzFormModule,
        NzSelectModule,
        NzIconModule,
        FormsModule,
        NzButtonModule,
        NzDividerModule,
        NzModalModule,
        NzInputModule,
        ReactiveFormsModule,
        NzInputNumberModule,
        NzTransferModule,
        DragDropModule,
        NzTagModule,
        EditorForAngularModule,
        NzSwitchModule,
        NzLayoutModule,
        NzMenuModule,
        RouterLinkActive,
        RouterOutlet,
        NzTreeModule
    ],
  providers: [NzModalService, NzMessageService]
})
export class SystemModule {
}
