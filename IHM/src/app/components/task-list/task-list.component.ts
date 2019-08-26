import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-task-list',
  templateUrl: './task-list.component.html',
  styleUrls: ['./task-list.component.scss']
})
export class TaskListComponent implements OnInit {

  editField: string;
  taskList: Array<any> = [
    { id: 1, title: 'Aurelia Vega', description: 30, status: 'Deepends', },
    { id: 2, title: 'Guerra Cortez', description: 45, status: 'Insectus', },
    { id: 3, title: 'Guadalupe House', description: 26, status: 'Isotronic', },
    { id: 4, title: 'Aurelia Vega', description: 30, status: 'Deepends', },
    { id: 5, title: 'Elisa Gallagher', description: 31, status: 'Portica', },
  ];

  awaitingTaskList: Array<any> = [
    { id: 6, title: 'George Vega', description: 28, status: 'Classical',  },
    { id: 7, title: 'Mike Low', description: 22, status: 'Lou', },
    { id: 8, title: 'John Derp', description: 36, status: 'Derping', },
    { id: 9, title: 'Anastasia John', description: 21, status: 'Ajo',  },
    { id: 10, title: 'John Maklowicz', description: 36, status: 'Mako',  },
  ];
  
  constructor() { }

  ngOnInit() {
  }

  updateList(id: number, property: string, event: any) {
    const editField = event.target.textContent;
    this.taskList[id][property] = editField;
    console.log(this.taskList)
  }

  remove(id: any) {
    this.awaitingTaskList.push(this.taskList[id]);
    this.taskList.splice(id, 1);
    console.log(this.taskList)
  }
  add() {
    if (this.awaitingTaskList.length > 0) {
      const task = this.awaitingTaskList[0];
      this.taskList.push(task);
      this.awaitingTaskList.splice(0, 1);
      console.log(this.taskList)
    }
  }

  changeValue(id: number, property: string, event: any) {
    this.editField = event.target.textContent;
    console.log(this.taskList)
  }
}
