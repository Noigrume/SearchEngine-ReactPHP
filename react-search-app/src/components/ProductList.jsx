import React from "react";

function ProductList({ products }) {
  return (
    <ul className="product-list">
      {products.map((product, index) => (
        <li className="product">
          <span class="card-ranked">{index + 1}</span>
          <figcaption>
            <h4>
              <span className="product-title">{product.title}</span>
            </h4>
            <p className="product-maintag">{product.main_tag}</p>
          </figcaption>
        </li>
      ))}
    </ul>
  );
}

export default ProductList;
