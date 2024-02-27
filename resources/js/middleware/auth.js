import { useProfileStore } from '@js/stores/profileStore'

export default async function auth({ next }) {
  const profile = useProfileStore()

  if (!profile.token) {
    return next({ name: 'Login' });
  }

  return next();
}