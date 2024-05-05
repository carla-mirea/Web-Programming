import { RouterModule, Routes } from '@angular/router';

import { NgModule } from '@angular/core';
import { CrudBooksComponent } from './crud-books/crud-books.component';
import { BooksHomeComponent } from './books-home/books-home.component';
import { BooksFilterComponent } from './books-filter/books-filter.component';

export const routes: Routes = [
    {path: 'crud-books', component: CrudBooksComponent},
    {path: 'books-home', component: BooksHomeComponent},
    {path: 'books-filter', component: BooksFilterComponent},
];

@NgModule({
    imports: [RouterModule.forRoot(routes)],
    exports: [RouterModule]
})
export class AppRoutingModule { }
