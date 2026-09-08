import React from 'react';
import { useCartStore } from '../store/cartStore';

export default function CartDrawer() {
  const { cart, isOpen, toggleCart, removeFromCart, clearCart } = useCartStore();

  if (!isOpen) return null;

  const total = cart.reduce((acc, item) => acc + item.price * item.quantity, 0);

  // Generar mensaje estructurado para WhatsApp
  const handleWhatsAppCheckout = () => {
    let message = "Hola, me interesa realizar el siguiente pedido en Deparota:\n\n";
    cart.forEach((item) => {
      message += `▪ *${item.name}* (SKU: ${item.sku || 'N/D'}) - Cantidad: ${item.quantity} - Subtotal: $${(item.price * item.quantity).toLocaleString('es-MX')} MXN\n`;
    });
    message += `\n*Total estimado: $${total.toLocaleString('es-MX')} MXN*\n\n¿Me confirman disponibilidad y detalles de pago por favor?`;

    const encodedMessage = encodeURIComponent(message);
    // Reemplaza con el número real de WhatsApp de Deparota (ej. 527220000000)
    const whatsappUrl = `https://wa.me/527220000000?text=${encodedMessage}`;
    
    window.open(whatsappUrl, '_blank');
  };

  return (
    <div className="fixed inset-0 z-50 overflow-hidden">
      {/* Backdrop */}
      <div 
        className="absolute inset-0 bg-black/40 backdrop-blur-sm transition-opacity"
        onClick={toggleCart}
      />

      <div className="absolute inset-y-0 right-0 max-w-full flex pl-10">
        <div className="w-screen max-w-md bg-white shadow-2xl flex flex-col">
          {/* Header */}
          <div className="px-6 py-6 border-b border-stone-200 flex items-center justify-between">
            <h2 className="font-serif text-xl font-bold">Tu Lista de Interés</h2>
            <button 
              onClick={toggleCart}
              className="text-stone-400 hover:text-stone-700 text-xl font-bold"
            >
              ✕
            </button>
          </div>

          {/* Body / Items */}
          <div className="flex-1 overflow-y-auto px-6 py-4 space-y-4">
            {cart.length === 0 ? (
              <div className="text-center py-20 text-stone-500">
                <p>Tu carrito está vacío.</p>
                <p className="text-sm mt-1">Explora el catálogo y añade piezas de parota.</p>
              </div>
            ) : (
              cart.map((item) => (
                <div key={item.id} className="flex gap-4 items-center border-b border-stone-100 pb-4">
                  <img src={item.image_url} alt={item.name} className="w-20 h-20 object-cover rounded-xl bg-stone-100" />
                  <div className="flex-1">
                    <h3 className="font-serif font-bold text-sm">{item.name}</h3>
                    <p className="text-xs text-stone-500">${Number(item.price).toLocaleString('es-MX')} MXN x {item.quantity}</p>
                  </div>
                  <button 
                    onClick={() => removeFromCart(item.id)}
                    className="text-red-500 text-xs hover:underline font-medium"
                  >
                    Eliminar
                  </button>
                </div>
              ))
            )}
          </div>

          {/* Footer */}
          {cart.length > 0 && (
            <div className="px-6 py-6 border-t border-stone-200 bg-stone-50">
              <div className="flex justify-between items-center mb-4">
                <span className="text-stone-600 font-medium">Total Estimado</span>
                <span className="text-2xl font-bold text-stone-900">${total.toLocaleString('es-MX')} <span className="text-xs font-normal text-stone-500">MXN</span></span>
              </div>
              <button
                onClick={handleWhatsAppCheckout}
                className="w-full bg-[#171717] text-white py-3.5 rounded-xl font-medium hover:bg-stone-800 transition-colors shadow-sm text-center block mb-3"
              >
                Enviar pedido por WhatsApp
              </button>
              <button
                onClick={clearCart}
                className="w-full text-stone-500 text-xs text-center hover:text-stone-800"
              >
                Vaciar lista
              </button>
            </div>
          )}
        </div>
      </div>
    </div>
  );
}