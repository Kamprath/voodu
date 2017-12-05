import Model from './Model.js';

class Card extends Model {
    get source() {
        return '/api/cards';
    }
}

export default Card;