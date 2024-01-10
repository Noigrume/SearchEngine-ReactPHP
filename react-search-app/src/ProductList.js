import React from 'react';

function ProductList({ products }) {
    return (
        <ul>
            {products.map(product => (
                <li key={product.product_id}>
                    <h3>{product.title}</h3>
                    <p>Tag: {product.tag}</p>
                </li>
            ))}
        </ul>
    );
}

export default ProductList;
