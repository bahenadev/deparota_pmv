import { create } from 'zustand';

export interface CartItem {
  id: number;
  name: string;
  price: number;
  image_url: string;
  sku?: string;
  quantity: number;
}

interface CartStore {
  cart: CartItem[];
  isOpen: boolean;
  toggleCart: () => void;
  addToCart: (product: Omit<CartItem, 'quantity'>) => void;
  removeFromCart: (productId: number) => void;
  clearCart: () => void;
}

export const useCartStore = create<CartStore>((set) => ({
  cart: [],
  isOpen: false,
  toggleCart: () => set((state) => ({ isOpen: !state.isOpen })),
  addToCart: (product) => {
    set((state) => {
      const existingIndex = state.cart.findIndex((item) => item.id === product.id);
      if (existingIndex > -1) {
        const newCart = [...state.cart];
        newCart[existingIndex].quantity += 1;
        return { cart: newCart, isOpen: true };
      }
      return { cart: [...state.cart, { ...product, quantity: 1 }], isOpen: true };
    });
  },
  removeFromCart: (productId) => {
    set((state) => ({
      cart: state.cart.filter((item) => item.id !== productId)
    }));
  },
  clearCart: () => set({ cart: [] }),
}));