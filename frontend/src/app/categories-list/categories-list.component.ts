import { Component, OnInit } from '@angular/core';
import {CategoriesService} from './categories.service';
import {ResponseCategories} from './categories.model';
import { faEye, faEdit, faMinusCircle, faPlus } from '@fortawesome/free-solid-svg-icons';

import { CategoriesAddComponent} from '../categories-add/categories-add.component';
import {NgbModal} from '@ng-bootstrap/ng-bootstrap';
import {CategoriesViewComponent} from '../categories-view/categories-view.component';

@Component({
  selector: 'app-categories-list',
  templateUrl: './categories-list.component.html',
  styleUrls: ['./categories-list.component.sass']
})
export class CategoriesListComponent implements OnInit {

  faEye = faEye;
  faEdit = faEdit;
  faMinusCircle = faMinusCircle;
  faPlus = faPlus;

  responseCategories: ResponseCategories;

  constructor(private categoriesServices: CategoriesService, private modalService: NgbModal) { }

  ngOnInit(): void {
    this.getCategories();
  }

  getCategories(): void {
    this.categoriesServices
      .getCategories()
      .subscribe(
        res => {
          return this.responseCategories = res;
        }
      );
  }

  addCategory(): void {
    const modalRef = this.modalService.open(CategoriesAddComponent);
    modalRef.result.then((result) => {
      this.getCategories();
    }).catch((error) => {
      console.log(error);
    });
  }

  editCategory(item: array): void {
    const modalRef = this.modalService.open(CategoriesAddComponent);
    modalRef.componentInstance.id = item.id;
    modalRef.componentInstance.category = item.category;
    modalRef.componentInstance.description = item.description;
    modalRef.result.then((result) => {
      this.getCategories();
    }).catch((error) => {
      console.log(error);
    });
  }

  deleteCategory(id: int): void {
    this.categoriesServices
      .deleteCategory(id)
      .subscribe(res => {
        this.getCategories();
      });
  }

  viewCategory(id: int): void {
    const modalRef = this.modalService.open(CategoriesViewComponent);
    modalRef.componentInstance.id = id;
    modalRef.result.then((result) => {
      return;
    }).catch((error) => {
      console.log(error);
    });
  }
}
