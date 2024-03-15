import { ComponentFixture, TestBed } from '@angular/core/testing';

import { OrderRevenuesConfigComponent } from './order-revenues-config.component';

describe('OrderRevenuesConfigComponent', () => {
  let component: OrderRevenuesConfigComponent;
  let fixture: ComponentFixture<OrderRevenuesConfigComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ OrderRevenuesConfigComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(OrderRevenuesConfigComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
