import {RouterModule, Routes} from "@angular/router";
import {NgModule} from "@angular/core";
import {LayoutComponent} from "../system/layout/layout.component";


const platformRoutes: Routes = [
  {
    path: '', component: LayoutComponent,
    children: [

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
export class WechatRoutingModule {
}
