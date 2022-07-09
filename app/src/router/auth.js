export default function auth({ next }) {
    if (!localStorage.getItem('token')) {
      return next("/login");
    }
  
    return next();
  }