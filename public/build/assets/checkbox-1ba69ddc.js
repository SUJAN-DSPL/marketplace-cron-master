import{r as t,k as I,m as M,y as S,o as w,_ as C,p as y,E as D,F as q,j as k,c as g}from"./app-4b28f7de.js";import{C as B}from"./theme-toggler-684e7332.js";function O(e){const o=t.useRef({value:e,previous:e});return t.useMemo(()=>(o.current.value!==e&&(o.current.previous=o.current.value,o.current.value=e),o.current.previous),[e])}const R="Checkbox",[A,U]=I(R),[K,L]=A(R),F=t.forwardRef((e,o)=>{const{__scopeCheckbox:r,name:d,checked:l,defaultChecked:a,required:b,disabled:i,value:u="on",onCheckedChange:$,...v}=e,[n,h]=t.useState(null),N=M(o,c=>h(c)),x=t.useRef(!1),E=n?!!n.closest("form"):!0,[f=!1,m]=S({prop:l,defaultProp:a,onChange:$}),j=t.useRef(f);return t.useEffect(()=>{const c=n==null?void 0:n.form;if(c){const p=()=>m(j.current);return c.addEventListener("reset",p),()=>c.removeEventListener("reset",p)}},[n,m]),t.createElement(K,{scope:r,state:f,disabled:i},t.createElement(w.button,C({type:"button",role:"checkbox","aria-checked":s(f)?"mixed":f,"aria-required":b,"data-state":_(f),"data-disabled":i?"":void 0,disabled:i,value:u},v,{ref:N,onKeyDown:y(e.onKeyDown,c=>{c.key==="Enter"&&c.preventDefault()}),onClick:y(e.onClick,c=>{m(p=>s(p)?!0:!p),E&&(x.current=c.isPropagationStopped(),x.current||c.stopPropagation())})})),E&&t.createElement(X,{control:n,bubbles:!x.current,name:d,value:u,checked:f,required:b,disabled:i,style:{transform:"translateX(-100%)"}}))}),H="CheckboxIndicator",T=t.forwardRef((e,o)=>{const{__scopeCheckbox:r,forceMount:d,...l}=e,a=L(H,r);return t.createElement(D,{present:d||s(a.state)||a.state===!0},t.createElement(w.span,C({"data-state":_(a.state),"data-disabled":a.disabled?"":void 0},l,{ref:o,style:{pointerEvents:"none",...e.style}})))}),X=e=>{const{control:o,checked:r,bubbles:d=!0,...l}=e,a=t.useRef(null),b=O(r),i=q(o);return t.useEffect(()=>{const u=a.current,$=window.HTMLInputElement.prototype,n=Object.getOwnPropertyDescriptor($,"checked").set;if(b!==r&&n){const h=new Event("click",{bubbles:d});u.indeterminate=s(r),n.call(u,s(r)?!1:r),u.dispatchEvent(h)}},[b,r,d]),t.createElement("input",C({type:"checkbox","aria-hidden":!0,defaultChecked:s(r)?!1:r},l,{tabIndex:-1,ref:a,style:{...e.style,...i,position:"absolute",pointerEvents:"none",opacity:0,margin:0}}))};function s(e){return e==="indeterminate"}function _(e){return s(e)?"indeterminate":e?"checked":"unchecked"}const P=F,z=T,G=t.forwardRef(({className:e,...o},r)=>k.jsx(P,{ref:r,className:g("peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground",e),...o,children:k.jsx(z,{className:g("flex items-center justify-center text-current"),children:k.jsx(B,{className:"h-4 w-4"})})}));G.displayName=P.displayName;export{O as $,G as C};