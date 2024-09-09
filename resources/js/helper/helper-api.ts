import { Task } from "../task/model/task";

export class Api {
  token: string | undefined;

  constructor() {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content');
    if(token) {
      this.token = token;
    }
  }

  static getHeaders(): Record<string, string> {
    const token = document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '';
    return {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": token
    };
  }

  static async getTaskApi () {
    try {
      const res = await fetch("/tasksapi",{
        method: "GET",
        headers: this.getHeaders(),
      });
      const data = await res.json(); 
      console.log(data);
      return data;
    } catch (error) {
      console.log(error);
    }
    return [];
  }

  static async addTaskApi(title:string, body: string) {
    try {
      const res = await fetch("/tasksapi",{
        method: "POST",
        headers: this.getHeaders(),
        body: JSON.stringify({
          title,
          body
        })
      });
      const data = await res.json(); 
      console.log(data);
      return data;
    } catch (error) {
      console.log(error);
    }
    return [];
  }

  static async updateTaskApi(task: Task, title: string, body: string) {
    try {
      const res = await fetch(`/tasksapi/${task.id}`,{
        method: "PUT",
        headers: this.getHeaders(),
        body: JSON.stringify({
          title,
          body
        })
      });
      const data = await res.json(); 
      console.log(data);
      return data;
    } catch (error) {
      console.log(error);
    }
    return [];
  }

  static async deleteTaskApi(task: Task) {
    try {
      const res = await fetch(`/tasksapi/${task.id}`,{
        method: "DELETE",
        headers: this.getHeaders(),
      });
      const data = await res.json(); 
      console.log(data);
      return data;
    } catch (error) {
      console.log(error);
    }
    return [];
  } 
}

