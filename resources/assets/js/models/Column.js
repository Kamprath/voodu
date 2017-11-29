import Model from './Model.js';

class Column extends Model {
    get source() {
        return '/api/columns';
    }
}

export default Column;