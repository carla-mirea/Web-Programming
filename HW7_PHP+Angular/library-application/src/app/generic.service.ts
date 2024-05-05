import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Observable, catchError, of } from 'rxjs';
import { Book } from './book';

@Injectable({
  providedIn: 'root'
})
export class GenericService {

  constructor(private http: HttpClient) { }

  private backendUrl = 'http://localhost/booksLibraryForAngular/controller/controller.php'; // URL to web api
  
  httpOptions = {
    headers: new HttpHeaders({
      'Content-Type': 'application/json'
    })
  };

  fetchBooks(): Observable<Book[]>{
    return this.http.get<Book[]>(this.backendUrl+'?action=selectAllBooks')
      .pipe(catchError(this.handleError<Book[]>('fetchBooks', [])));
  }

  fetchGenres(): Observable<string[]>{
    let url = `${this.backendUrl}?action=getGenres`;
    return this.http.get<string[]>(url)
      .pipe(catchError(this.handleError<string[]>('fetchGenres', [])));
  }

  fetchBooksByGenre(genre: string): Observable<Book[]>{
    let url = `${this.backendUrl}?action=getFilteredBooksByGenre&genre=${genre}`;
    return this.http.get<Book[]>(url)
      .pipe(catchError(this.handleError<Book[]>('fetchBooksByGenre', [])));
  }

  /** POST: add a new book to the database */
  addBook(bk: Book): Observable<any>{
    let url = `${this.backendUrl}?action=addBook&id=${bk.id}&title=${bk.title}&author=${bk.author}&pages=${bk.pages}&genre=${bk.genre}`
    return this.http.get<string>(url)
      .pipe(catchError(this.handleError<string>('addBook', "")));
  }

  updateBook(bk: Book): Observable<any>{
    let url = `${this.backendUrl}?action=updateBook&id=${bk.id}&title=${bk.title}&author=${bk.author}&pages=${bk.pages}&genre=${bk.genre}`
    return this.http.get<string>(url)
      .pipe(catchError(this.handleError<string>('updateBook', "")));

  }

  deleteBook(id: number): Observable<any>{
    let url = `${this.backendUrl}?action=deleteBook&id=${id}`
    return this.http.get<string>(url)
      .pipe(catchError(this.handleError<string>('deleteBook', "")));
  }

  /**
   * Handle Http operation that failed.
   * Let the app continue.
   * @param operation - name of the operation that failed
   * @param result - optional value to return as the observable result
   */
   private handleError<T>(operation = 'operation', result?: T) {
    return (error: any): Observable<T> => {
      // TO DO: send the error to remote logging infrastructure
      console.error(error); // log to console instead
      // Let the app keep running by returning an empty result.
      return of(result as T);
    };
  }
}
