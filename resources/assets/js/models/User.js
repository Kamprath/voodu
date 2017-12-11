import Model from './Model';

class User extends Model {
    get source() {
        return '/api/users';
    }
}

export default User;