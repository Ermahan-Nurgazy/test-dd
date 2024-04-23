export const getItem = key => {
  try {
    return localStorage.getItem(key)
  } catch (e) {
    console.error('Error in getting data from localStorage', e)
    return null
  }
}

export const setItem = (key, data) => {
  try {
    localStorage.setItem(key, data)
  } catch (e) {
    console.error('Error in setting data to localStorage', e)
  }
}
