import {Component, Input, OnInit} from '@angular/core';
import {NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';
import {CategoriesService} from '../categories-list/categories.service';
import {Category} from '../categories-list/categories.model';

@Component({
  selector: 'app-categories-view',
  templateUrl: './categories-view.component.html',
  styleUrls: ['./categories-view.component.sass']
})
export class CategoriesViewComponent implements OnInit{

  @Input() id: number;

  category: Category;

  constructor(
    public activeModal: NgbActiveModal,
    private categoriesService: CategoriesService
  ) {
  }

  ngOnInit() {
    this.getCategory();
  }

  getCategory(): void {
    this.categoriesService
      .getCategory(this.id)
      .subscribe(res => {
        this.category = res;
      });
  }

}
