import { NgModule } from '@angular/core';
import { RouterModule, Routes } from '@angular/router';

const routes: Routes = [
  {
    path: 'login',
    loadChildren: () => import('./modules/auth/auth.module').then(m => m.AuthModule),
  },
  // {
  //   path: 'platform',
  //   loadChildren: () => import('./pages/platform/platform.module').then(m => m.PlatformModule),
  //   canMatch: [AdminGuard]
  // },
  {path: '**', redirectTo: '/', pathMatch: 'full'},
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
