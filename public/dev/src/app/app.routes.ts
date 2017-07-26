import {Routes,RouterModule} from '@angular/router';
import {ModuleWithProviders} from '@angular/core';
import {DashboardDemo} from './demo/view/dashboarddemo';
import {SampleDemo} from './demo/view/sampledemo';
import {FormsDemo} from './demo/view/formsdemo';
import {DataDemo} from './demo/view/datademo';
import {PanelsDemo} from './demo/view/panelsdemo';
import {OverlaysDemo} from './demo/view/overlaysdemo';
import {MenusDemo} from './demo/view/menusdemo';
import {MessagesDemo} from './demo/view/messagesdemo';
import {MiscDemo} from './demo/view/miscdemo';
import {EmptyDemo} from './demo/view/emptydemo';
import {ChartsDemo} from './demo/view/chartsdemo';
import {FileDemo} from './demo/view/filedemo';
import {UtilsDemo} from './demo/view/utilsdemo';
import {Documentation} from './demo/view/documentation';

/** MY COMPONENT **/
import {AppLogin} from './components/layouts/login/app.login.component';
import {DashboardComponent} from './components/layouts/dashboard/app.dashboard.component';
import {CategoryComponent} from './components/main/category/category.component';
import {UserComponent} from './components/main/user/user.component';
import {CustomerComponent} from './components/main/customer/customer.component';
import {ItemComponent} from './components/main/item/item.component';
import {PositionComponent} from './components/main/position/position.component';
import {AppointmentComponent} from './components/main/appointment/appointment.component';
import {MarketingComponent} from './components/main/marketing/marketing.component';
import {CommissionComponent} from './components/main/commission/commission.component';

export const routes: Routes = [
    {path: '', redirectTo: 'dashboard', pathMatch: 'full'},
    {path: 'dashboard', component: DashboardComponent},
    {path: 'dashboards', component: DashboardDemo},
    {path: 'sample', component: SampleDemo},
    {path: 'forms', component: FormsDemo},
    {path: 'data', component: DataDemo},
    {path: 'panels', component: PanelsDemo},
    {path: 'overlays', component: OverlaysDemo},
    {path: 'menus', component: MenusDemo},
    {path: 'messages', component: MessagesDemo},
    {path: 'misc', component: MiscDemo},
    {path: 'empty', component: EmptyDemo},
    {path: 'charts', component: ChartsDemo},
    {path: 'file', component: FileDemo},
    {path: 'utils', component: UtilsDemo},
    {path: 'documentation', component: Documentation},

    {path: 'login', component: AppLogin},
    {path: 'categories', component: CategoryComponent},
    {path: 'employees', component: UserComponent},
    {path: 'customers', component: CustomerComponent},
    {path: 'items', component: ItemComponent},
    {path: 'positions', component: PositionComponent},
    {path: 'appointment', component: AppointmentComponent},
    {path: 'marketing', component: MarketingComponent},
    {path: 'commissions', component: CommissionComponent},
];

export const AppRoutes: ModuleWithProviders = RouterModule.forRoot(routes);
