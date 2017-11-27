import Model from './Model.js';

class Board extends Model {
    get route() {
        return '/api/boards';
    }
}

export default Board;