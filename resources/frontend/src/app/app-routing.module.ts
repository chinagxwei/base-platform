import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';
import {appGuard} from "./guards/app.guard";

const routes: Routes = [
  {
    path: 'login',
    loadChildren: () => import('./modules/auth/auth.module').then(m => m.AuthModule),
  },
  {
    path: 'system',
    loadChildren: () => import('./modules/system/system.module').then(m => m.SystemModule),
    canActivate: [appGuard]
  },
  {path: '**', redirectTo: '/system', pathMatch: 'full'},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
