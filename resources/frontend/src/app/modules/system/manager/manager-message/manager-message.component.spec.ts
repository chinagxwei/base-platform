import { ComponentFixture, TestBed } from '@angular/core/testing';

import { ManagerMessageComponent } from './manager-message.component';

describe('ManagerMessageComponent', () => {
  let component: ManagerMessageComponent;
  let fixture: ComponentFixture<ManagerMessageComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      declarations: [ ManagerMessageComponent ]
    })
    .compileComponents();

    fixture = TestBed.createComponent(ManagerMessageComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
