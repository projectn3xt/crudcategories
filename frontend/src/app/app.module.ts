import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';

import {NgbModule} from '@ng-bootstrap/ng-bootstrap';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { CategoriesListComponent } from './categories-list/categories-list.component';
import {HttpClientModule} from '@angular/common/http';
import { FontAwesomeModule } from '@fortawesome/angular-fontawesome';
import { CategoriesAddComponent } from './categories-add/categories-add.component';
import {FormsModule, ReactiveFormsModule} from '@angular/forms';
import {SweetAlert2Module} from '@sweetalert2/ngx-sweetalert2';
import { CategoriesViewComponent } from './categories-view/categories-view.component';

@NgModule({
  declarations: [
    AppComponent,
    CategoriesListComponent,
    CategoriesAddComponent,
    CategoriesViewComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule,
    AppRoutingModule,
    NgbModule,
    FontAwesomeModule,
    FormsModule,
    ReactiveFormsModule,
    SweetAlert2Module,
  ],
  providers: [],
  bootstrap: [AppComponent],
  entryComponents: [
    CategoriesAddComponent,
    CategoriesViewComponent,
  ]
})
export class AppModule { }
