import React, { useEffect, useState } from "react";
import "./style.css";

export default function Product() {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState(null);

  useEffect(() => {
    const fetchdata = async () => {
      try {
        const response = await fetch("https://fakestoreapi.com/products");
        if (!response.ok) {
          throw new Error(`Error came in the apis ${response.status}`);
        }
        let data = await response.json();
        setProducts(data);
      } catch (err) {
        setError(err.message);
      } finally {
        setLoading(false);
      }
    };
    fetchdata();
  }, []);

  if (loading) return <>loading the Product</>;
  if (error) return <>Error came {error}</>;

  return (
    <>
      <h2>products are fetched</h2>
      {products.map((product) => {
        return (
          <div key={product.id}>
            <h5>{product.id}</h5>
            <h4>{product.title}</h4>
            <img src={product.image} alt={product.title} width="100" />
            <p>Price: ${product.price}</p>
            <p>Category: {product.category}</p>
          </div>
        );
      })}
    </>
  );
}
