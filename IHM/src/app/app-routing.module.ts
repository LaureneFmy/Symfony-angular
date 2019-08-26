import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginRegisterComponent } from './components/login-register/login-register.component';
import { HomeComponent } from './components/home/home.component';
import { TaskListComponent } from './components/task-list/task-list.component';
import { TaskDetailComponent } from './components/task-detail/task-detail.component';
import { TaskCreatedComponent } from './components/task-created/task-created.component';


const routes: Routes = [
  {path:'', component			: LoginRegisterComponent},
  {path:'home/:userId', component			: HomeComponent,
  children: [
    {
        path: ':userId',
        component: TaskListComponent,
        outlet: 'list'
    },
    {
        path: ':taskId',
        component: TaskDetailComponent,
        outlet: 'component'
    },
    {
      path: ':userId/:taskId',
      component: TaskCreatedComponent,
      outlet: 'created'
    }
]},
  {path:'task/list', component			: LoginRegisterComponent},

];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
