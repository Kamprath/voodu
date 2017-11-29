import Model from './Model.js';

class Board extends Model {
    get source() {
        return '/api/boards';
    }
}

export default Board;