import React, { useEffect, useState } from "react";

export default function Store() {
  const [data, setData] = useState([]);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    getProduct();
  }, []);

  async function getProduct() {
    try {
      const response = await fetch("https://fakestoreapi.com/products");
      if (!response.ok)
        throw new Error(`HTTP error! Status: ${response.status}`);
      const products = await response.json();
      setData(products);
    } catch (err) {
      console.error("Fetch error:", err);
    } finally {
      setLoading(false);
    }
  }

  return (
    <div className="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
      {/* Header */}
      <div className="flex justify-between items-center mb-10">
        <h1 className="text-3xl font-bold text-gray-900">Our Products</h1>
        <div className="flex space-x-4">
          <button className="px-4 py-2 border rounded-md text-gray-700 hover:bg-gray-100">
            Categories
          </button>
          <button className="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
            Sort By
          </button>
        </div>
      </div>

      {loading ? (
        <div className="flex justify-center items-center h-64">
          <div className="animate-spin rounded-full h-12 w-12 border-t-2 border-b-2 border-blue-500"></div>
        </div>
      ) : (
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
          {data.map((product) => (
            <div
              key={product.id}
              className="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col"
            >
              {/* Product Image */}
              <div className="h-48 overflow-hidden flex items-center justify-center bg-gray-100">
                <img
                  src={product.image}
                  alt={product.title}
                  className="h-full object-contain p-4 hover:scale-105 transition-transform duration-300"
                />
              </div>

              {/* Product Info */}
              <div className="p-6 flex-grow flex flex-col">
                <div className="flex justify-between items-start mb-2">
                  <span className="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded">
                    {product.category}
                  </span>
                  <p className="text-lg font-bold text-gray-900">
                    ${product.price}
                  </p>
                </div>

                <h3 className="text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                  {product.title}
                </h3>

                {/* Buttons */}
                <div className="mt-auto flex space-x-2">
                  <button className="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-2 px-4 rounded-md transition-colors duration-200">
                    Add to Cart
                  </button>
                  <button className="flex-1 border border-gray-300 hover:bg-gray-100 text-gray-700 py-2 px-4 rounded-md transition-colors duration-200">
                    View
                  </button>
                </div>
              </div>
            </div>
          ))}
        </div>
      )}
    </div>
  );
}
