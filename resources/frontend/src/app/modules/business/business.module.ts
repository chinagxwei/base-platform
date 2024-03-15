import {NgModule} from "@angular/core";
import {CommonModule} from "@angular/common";
import {NzModalService} from "ng-zorro-antd/modal";
import {NzMessageService} from "ng-zorro-antd/message";
import {BusinessRoutingModule} from "./business-routing.module";
import {AreaComponent} from './area/area.component';
import {VenueComponent} from './venue/venue.component';
import { ScheduleComponent } from './schedule/schedule.component';
import { ProductComponent } from './product/product.component';
import { OrderComponent } from './order/order.component';
import { OrderRevenuesConfigComponent } from './order/order-revenues-config/order-revenues-config.component';
import { VipComponent } from './product/vip/vip.component';


@NgModule({
  declarations: [
    AreaComponent,
    VenueComponent,
    ScheduleComponent,
    ProductComponent,
    OrderComponent,
    OrderRevenuesConfigComponent,
    VipComponent
  ],
  imports: [
    CommonModule,
    BusinessRoutingModule
  ],
  providers: [NzModalService, NzMessageService]
})
export class BusinessModule {
}
