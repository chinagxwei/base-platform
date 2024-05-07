import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {DashboardComponent} from "./dashboard/dashboard.component";
import {LayoutComponent} from "../system/layout/layout.component";

const routes: Routes = [
  {
    path: '', component: LayoutComponent,
    children: [
      {path: '', component: DashboardComponent},
    ]
  },
];

@NgModule({
  imports: [
    RouterModule.forChild(routes)
  ],
  exports: [
    RouterModule
  ]
})
export class EnterpriseRoutingModule {
}
