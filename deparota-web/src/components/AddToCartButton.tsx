import React from 'react';
import { useCartStore } from '../store/cartStore';

interface Props {
  product: {
    id: number;
    name: string;
    price: number;
    image_url: string;
    sku?: string;
  };
}

export default function AddToCartButton({ product }: Props) {
  const addToCart = useCartStore((state) => state.addToCart);

  return (
    <button
      onClick={() => addToCart(product)}
      className="bg-[#171717] text-white px-4 py-2.5 rounded-xl text-sm font-medium hover:bg-stone-800 transition-colors shadow-sm"
    >
      Añadir a lista
    </button>
  );
}