import { Component, OnInit } from '@angular/core';
import { Book } from '../book';
import { GenericService } from '../generic.service';
import { FormsModule } from '@angular/forms';
import { CommonModule } from '@angular/common';

@Component({
  selector: 'app-books-filter',
  standalone: true,
  imports: [FormsModule, CommonModule],
  templateUrl: './books-filter.component.html',
  styleUrl: './books-filter.component.css'
})
export class BooksFilterComponent implements OnInit{
  selectedOption: string = '';
  genres: string[] = [];
  filteredBks: Book[] = [];

  prevOption: string = 'None';
  optionHistory: string[] = ["None"];

  constructor(private genericService: GenericService) { }

  ngOnInit(): void {
    this.getGenres();
  }

  getGenres(): void{
    this.genericService.fetchGenres()
      .subscribe(genres => this.genres = genres);
  }

  getFilteredBooksByGenre(): void{
    this.prevOption = this.optionHistory[this.optionHistory.length - 1];
    this.optionHistory.push(this.selectedOption);
    this.genericService.fetchBooksByGenre(this.selectedOption)
      .subscribe(books => {
        this.filteredBks = books;
      });
  }
}
