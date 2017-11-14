function store(data) {
    window.localStorage.tasks = JSON.stringify(data);
    Voodu.Events.$emit('tasks-changed');
}

class Tasks {
    static all() {
        const tasks = window.localStorage.tasks;
        return (typeof tasks !== 'string') ? [] : JSON.parse(tasks);
    }

    static create(title) {
        let tasks = this.all();
        tasks.push(title);
        store(tasks);
    }

    static delete(title) {
        let tasks = this.all();
        tasks.splice(tasks.indexOf(title), 1);
        store(tasks);
    }

    static find($id) {
        // todo: implement find() method
    }
}

export default Tasks;