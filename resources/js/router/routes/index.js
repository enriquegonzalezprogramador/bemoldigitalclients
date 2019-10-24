import auth from './auth';
import user from './user';
import employee from './employee';
import project from './project';
import warehouse from './warehouse';

export default [
  ...auth,
  ...user,
  ...employee,
  ...project,
  ...warehouse,

];
