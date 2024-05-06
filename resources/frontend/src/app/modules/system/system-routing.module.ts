import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {LayoutComponent} from "./layout/layout.component";
import {DashboardComponent} from "./dashboard/dashboard.component";
import {RouterComponent} from "./router/router.component";
import {RoleComponent} from "./role/role.component";
import {NavigationComponent} from "./navigation/navigation.component";
import {ImageComponent} from "./image/image.component";
import {ConfigComponent} from "./config/config.component";
import {LogComponent} from "./log/log.component";
import {AgreementComponent} from "./agreement/agreement.component";
import {ComplaintComponent} from "./complaint/complaint.component";
import {ManagerComponent} from "./manager/manager.component";
import {ManagerMessageComponent} from "./manager/manager-message/manager-message.component";
import {MessageComponent} from "./message/message.component";
import {EnterpriseComponent} from "./enterprise/enterprise.component";

const platformRoutes: Routes = [
  {
    path: '', component: LayoutComponent,
    children: [
      {path: '', component: DashboardComponent},
      {path: 'dashboard', component: DashboardComponent},
      {path: 'router', component: RouterComponent},
      {path: 'role', component: RoleComponent},
      {path: 'navigation', component: NavigationComponent},
      {path: 'message', component: MessageComponent},
      {path: 'manager', component: ManagerComponent},
      {path: 'manager-message', component: ManagerMessageComponent},
      {path: 'images', component: ImageComponent},
      {path: 'config', component: ConfigComponent},
      {path: 'action-log', component: LogComponent},
      {path: 'agreement', component: AgreementComponent},
      {path: 'complaint', component: ComplaintComponent},
      {path: 'enterprise', component: EnterpriseComponent},
    ]
  },
];

@NgModule({
  imports: [
    RouterModule.forChild(platformRoutes)
  ],
  exports: [
    RouterModule
  ]
})
export class SystemRoutingModule {
}
