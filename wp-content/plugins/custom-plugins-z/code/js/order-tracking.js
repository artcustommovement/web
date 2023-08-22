document.addEventListener("DOMContentLoaded", function() {
  const orderDateEl = document.querySelector(".order-date");
  const shippingDateEl = document.querySelector(".shipping-date");
  const deliveryDateEl = document.querySelector(".delivery-date");

  const currentDate = new Date();
  const weeks_start = parseInt(orderTracking.weeks_start, 10);
  const weeks_end = parseInt(orderTracking.weeks_end, 10);
  const shippingDateStart = new Date(currentDate.getTime() + weeks_start * 7 * 24 * 60 * 60 * 1000);
  const shippingDateEnd = new Date(currentDate.getTime() + weeks_end * 7 * 24 * 60 * 60 * 1000);
  const deliveryDateStart = new Date(shippingDateStart.getTime() + 10 * 24 * 60 * 60 * 1000);
  const deliveryDateEnd = new Date(shippingDateEnd.getTime() + 10 * 24 * 60 * 60 * 1000);

  const formatDate = (date) => {
    return `${date.getDate()} ${date.toLocaleString("en-US", { month: "short" })}`;
  };

  orderDateEl.textContent = formatDate(currentDate);
  shippingDateEl.textContent = `${formatDate(shippingDateStart)} - ${formatDate(shippingDateEnd)}`;
  deliveryDateEl.textContent = `${formatDate(deliveryDateStart)} - ${formatDate(deliveryDateEnd)}`;
});
