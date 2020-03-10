import {Injectable} from '@angular/core';
import {Category, RequestCreate, ResponseCategories, ResponseCreate} from './categories.model';
import {Observable} from 'rxjs';
import {HttpClient} from '@angular/common/http';

@Injectable({
  providedIn: 'root'
})

export class CategoriesService {

  constructor(private http: HttpClient) {}

  getCategories(): Observable<ResponseCategories> {
    return this.http.get<ResponseCategories>(`/api/categories/`);
  }

  createCategory(request: RequestCreate): Observable<ResponseCreate> {
    return this.http.post<ResponseCreate>(`/api/category/`, request);
  }

  getCategory(id: int): Observable<Category> {
    return this.http.get<Category>(`/api/category/${id}`);
  }

  updateCategory(request: RequestCreate, id: int): Observable<ResponseCreate> {
    return this.http.put<ResponseCreate>(`/api/category/${id}`, request);
  }

  deleteCategory(id: int): Observable<ResponseCreate> {
    return this.http.delete<ResponseCreate>(`/api/category/${id}`);
  }
}
