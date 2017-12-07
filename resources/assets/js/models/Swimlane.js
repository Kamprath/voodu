import Model from './Model.js';

class Swimlane extends Model {
    get source() {
        return '/api/swimlanes';
    }

    addCard(card) {
        this.cards.splice(card.position, 0, card);
    }
}

export default Swimlane;