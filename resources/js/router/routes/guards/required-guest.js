
import store from '@/js/store';

export default (to, from, next) => {
  if (store.getters['auth/isLoggedIn']) {
    next('/dashboard');
  } else {
    next();
  }
};
