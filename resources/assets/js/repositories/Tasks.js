import axios from 'axios';

let tasks = null;

function error(err) {
    Voodu.Events.$emit('show-modal', {
        title: 'Task API Error',
        message: err.message
    });
}

function fetch(callback) {
    axios.get('/api/tasks')
        .then(response => {
            tasks = response.data;
            Voodu.Events.$emit('tasks-changed');

            if (typeof callback === 'function') {
                callback(tasks);
            }
        })
        .catch(err => error(err));
}

class Tasks {

    static all(callback) {
        if (tasks === null && Voodu.bootstrapped.hasOwnProperty('tasks')) {
            tasks = Voodu.bootstrapped.tasks;
        }
        if (tasks === null && !Voodu.bootstrapped.hasOwnProperty('tasks')) {
            tasks = {};
            fetch(callback);
        }

        return tasks;
    }

    static create(title, callback) {
        axios.post('/api/tasks', { title })
            .then(response => {
                if (response.data.success === true) {
                    fetch(callback);
                }
            })
            .catch(err => error(err));
    }

    static delete(id, callback) {
        axios.delete('/api/tasks/' + id)
            .then(response => {
                if (response.data.success === true) {
                    fetch(callback);
                }
            })
            .catch(err => error(err));
    }

    static find($id) {
        // todo: implement find() method
    }
}

export default Tasks;