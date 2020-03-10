import {Component, Input, EventEmitter, Output} from '@angular/core';
import {NgbActiveModal} from '@ng-bootstrap/ng-bootstrap';
import {FormBuilder, FormGroup, Validators} from '@angular/forms';
import {RequestCreate, ResponseCreate} from '../categories-list/categories.model';
import {CategoriesService} from '../categories-list/categories.service';

@Component({
  selector: 'app-categories-add',
  templateUrl: './categories-add.component.html',
  styleUrls: ['./categories-add.component.sass']
})
export class CategoriesAddComponent {

  request: RequestCreate = {
    category: '',
    description: ''
  };

  response: ResponseCreate;

  @Input() id: number;
  @Input() category: string;
  @Input() description: string;

  myForm: FormGroup;
  constructor(
    public activeModal: NgbActiveModal,
    private formBuilder: FormBuilder,
    private categoriesService: CategoriesService
  ) {
    this.createForm();
  }

  private createForm() {
    this.myForm = this.formBuilder.group({
      category: ['', Validators.required],
      description: ['', Validators.required],
    });
  }

  private submitForm() {
    if (!this.id) {
      this.categoriesService.createCategory(this.myForm.value).subscribe( res => {
        this.response = res;
        this.activeModal.close(this.myForm.value);
      });
    } else {
      //console.log(this.myForm.value);
      this.categoriesService.updateCategory(this.myForm.value, this.id).subscribe( res => {
        this.response = res;
        this.activeModal.close(this.myForm.value);
      });
    }

  }


}
