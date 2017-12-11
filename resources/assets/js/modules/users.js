import bootstrapped from '../bootstrapped';
import User from '../models/User';

export default {

    state: {
        /**
         * All user models
         * @type array
         */
        models: bootstrapped.models('users', User),

        /**
         * The current user
         * @type User
         */
        user: new User(bootstrapped.get('user'))
    },

}