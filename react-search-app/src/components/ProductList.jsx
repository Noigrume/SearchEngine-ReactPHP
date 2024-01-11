import React from "react";

function ProductList({ products }) {
  return (
    <ul className="product-list">
      {products.map((product, index) => (
        <li className="product">
          <span class="card-ranked">{index + 1}</span>

          <section>
            <span className="product-title">{product.title}</span>
            <p className="product-maintag">{product.main_tag}</p>
          </section>
        </li>
      ))}
    </ul>
  );
}

export default ProductList;
