import axios from 'axios';

let tasks = null;

function error(err) {
    Voodu.Events.$emit('show-modal', {
        title: 'Task API Error',
        message: err.message
    });
}

function fetch() {
    axios.get('/api/tasks')
        .then(response => {
            tasks = response.data;
            Voodu.Events.$emit('tasks-changed');
        })
        .catch(err => error(err));
}

class Tasks {

    static all() {
        if (tasks === null && Voodu.bootstrapped.hasOwnProperty('tasks')) {
            tasks = Voodu.bootstrapped.tasks;
        }
        if (tasks === null && !Voodu.bootstrapped.hasOwnProperty('tasks')) {
            tasks = {};
            fetch();
        }

        return tasks;
    }

    static create(title) {
        axios.post('/api/tasks', { title })
            .then(response => {
                if (response.data.success === true) {
                    fetch();
                }
            })
            .catch(err => error(err));
    }

    static delete(id) {
        axios.delete('/api/tasks/' + id)
            .then(response => {
                if (response.data.success === true) {
                    fetch();
                }
            })
            .catch(err => error(err));
    }

    static find($id) {
        // todo: implement find() method
    }
}

export default Tasks;