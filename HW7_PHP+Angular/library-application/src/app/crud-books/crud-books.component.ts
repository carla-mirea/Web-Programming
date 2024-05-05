import { Component, OnInit } from '@angular/core';
import { Book } from '../book';
import { GenericService } from '../generic.service';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-crud-books',
  standalone: true,
  imports: [CommonModule],
  templateUrl: './crud-books.component.html',
  styleUrl: './crud-books.component.css'
})
export class CrudBooksComponent implements OnInit {
  books: Book[] = [];

  constructor(private genericService: GenericService) { }

  ngOnInit(): void {
    console.log("ngOnInit called for CarCrudComponent");
    this.getBooks();
  }

  getBooks(): void{
    this.genericService.fetchBooks()
      .subscribe(books => this.books = books);
  }

  onUpdate(bk: Book): void{
    (<HTMLInputElement>document.getElementById("id2")).value = String(bk.id);
    (<HTMLInputElement>document.getElementById("title2")).value = (bk.title);
    (<HTMLInputElement>document.getElementById("author2")).value = (bk.author);
    (<HTMLInputElement>document.getElementById("pages2")).value = String(bk.pages);
    (<HTMLInputElement>document.getElementById("genre2")).value = (bk.genre);
    
    let displayVal:string = document.getElementById('update_form')!.style.display;
    if (displayVal === "none")
      document.getElementById('update_form')!.style.display = "inline";
    else document.getElementById('update_form')!.style.display = "none";

  }

  onDelete(bkID: number): void{
    this.genericService.deleteBook(bkID).
    subscribe(r => {
      console.log(r.result);
      this.ngOnInit();
    });
  }

  addBook(newID: HTMLInputElement, newTitle: HTMLInputElement, newAuthor: HTMLInputElement, newPages: HTMLInputElement, newGenre: HTMLInputElement){
    let addedBook: Book = {id: + newID.value,
      title: newTitle.value,
      author: newAuthor.value,
      pages: +newPages.value,
      genre: newGenre.value,
    };

    this.genericService.addBook(addedBook)
    .subscribe(r => {
      console.log(r.result);
      this.ngOnInit();
    });

    (<HTMLInputElement>document.getElementById("id1")).value = ' ';
    (<HTMLInputElement>document.getElementById("title1")).value = ' ';
    (<HTMLInputElement>document.getElementById("author1")).value = ' ';
    (<HTMLInputElement>document.getElementById("pages1")).value = ' ';
    (<HTMLInputElement>document.getElementById("genre1")).value = ' ';


  }

  updateBook(uID: HTMLInputElement, uTitle: HTMLInputElement, uAuthor: HTMLInputElement , uPages: HTMLInputElement, uGenre: HTMLInputElement){
      let updatedBook: Book = {id: +uID.value,
      title: uTitle.value,
      author: uAuthor.value,
      pages: +uPages.value,
      genre: uGenre.value,
    };
    
    this.genericService.updateBook(updatedBook)
      .subscribe(r => {
        console.log(r.result);
        document.getElementById('update_form')!.style.display = "none";
        this.ngOnInit();
      });

  }

}
