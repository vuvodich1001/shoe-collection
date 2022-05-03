export const formatPrice = function (value) {
  return value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, '.') + ' ₫';
};

export const uniqueArray = function (arr) {
  return arr.filter((value, index, arr) => {
    return arr.indexOf(value) == index;
  });
};
