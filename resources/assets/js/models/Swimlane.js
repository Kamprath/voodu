import Model from './Model.js';

class Swimlane extends Model {
    get source() {
        return '/api/swimlanes';
    }
}

export default Swimlane;