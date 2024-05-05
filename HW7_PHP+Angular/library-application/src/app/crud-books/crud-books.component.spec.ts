import { ComponentFixture, TestBed } from '@angular/core/testing';

import { CrudBooksComponent } from './crud-books.component';

describe('CrudBooksComponent', () => {
  let component: CrudBooksComponent;
  let fixture: ComponentFixture<CrudBooksComponent>;

  beforeEach(async () => {
    await TestBed.configureTestingModule({
      imports: [CrudBooksComponent]
    })
    .compileComponents();
    
    fixture = TestBed.createComponent(CrudBooksComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
