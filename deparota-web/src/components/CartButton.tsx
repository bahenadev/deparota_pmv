import React from 'react';
import { useCartStore } from '../store/cartStore';

export default function CartButton() {
  const { cart, toggleCart } = useCartStore();
  const totalItems = cart.reduce((acc, item) => acc + item.quantity, 0);

  return (
    <button
      onClick={toggleCart}
      className="fixed bottom-6 right-6 bg-[#171717] text-white p-4 rounded-full shadow-2xl hover:bg-stone-800 transition-all z-40 flex items-center gap-2 group"
    >
      <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z" />
      </svg>
      {totalItems > 0 && (
        <span className="bg-stone-100 text-stone-900 text-xs font-bold px-2 py-0.5 rounded-full">
          {totalItems}
        </span>
      )}
    </button>
  );
}