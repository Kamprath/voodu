import Model from './Model.js';

class Board extends Model {
    get source() {
        return '/api/boards';
    }

    removeColumn(column) {
        for (let i in this.columns) {
            if (this.columns[i] === column) {
                delete this.columns.splice(i, 1);
                break;
            }
        }
    }
}

export default Board;