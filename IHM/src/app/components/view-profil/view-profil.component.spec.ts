import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { ViewProfilComponent } from './view-profil.component';

describe('ViewProfilComponent', () => {
  let component: ViewProfilComponent;
  let fixture: ComponentFixture<ViewProfilComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ ViewProfilComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(ViewProfilComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
