import{$ as I,r as t,l as S,m as D,n as w,_ as C,o as y,G as M,p as q,j as k,c as g}from"./app-0e1748b6.js";import{$ as B}from"./index-9f942153.js";import{C as O}from"./theme-toggler-b5671715.js";const _="Checkbox",[A,V]=I(_),[K,L]=A(_),H=t.forwardRef((e,n)=>{const{__scopeCheckbox:o,name:d,checked:u,defaultChecked:a,required:b,disabled:i,value:f="on",onCheckedChange:p,...v}=e,[r,h]=t.useState(null),N=S(n,c=>h(c)),m=t.useRef(!1),E=r?!!r.closest("form"):!0,[l=!1,x]=D({prop:u,defaultProp:a,onChange:p}),j=t.useRef(l);return t.useEffect(()=>{const c=r==null?void 0:r.form;if(c){const $=()=>x(j.current);return c.addEventListener("reset",$),()=>c.removeEventListener("reset",$)}},[r,x]),t.createElement(K,{scope:o,state:l,disabled:i},t.createElement(w.button,C({type:"button",role:"checkbox","aria-checked":s(l)?"mixed":l,"aria-required":b,"data-state":P(l),"data-disabled":i?"":void 0,disabled:i,value:f},v,{ref:N,onKeyDown:y(e.onKeyDown,c=>{c.key==="Enter"&&c.preventDefault()}),onClick:y(e.onClick,c=>{x($=>s($)?!0:!$),E&&(m.current=c.isPropagationStopped(),m.current||c.stopPropagation())})})),E&&t.createElement(z,{control:r,bubbles:!m.current,name:d,value:f,checked:l,required:b,disabled:i,style:{transform:"translateX(-100%)"}}))}),T="CheckboxIndicator",X=t.forwardRef((e,n)=>{const{__scopeCheckbox:o,forceMount:d,...u}=e,a=L(T,o);return t.createElement(M,{present:d||s(a.state)||a.state===!0},t.createElement(w.span,C({"data-state":P(a.state),"data-disabled":a.disabled?"":void 0},u,{ref:n,style:{pointerEvents:"none",...e.style}})))}),z=e=>{const{control:n,checked:o,bubbles:d=!0,...u}=e,a=t.useRef(null),b=B(o),i=q(n);return t.useEffect(()=>{const f=a.current,p=window.HTMLInputElement.prototype,r=Object.getOwnPropertyDescriptor(p,"checked").set;if(b!==o&&r){const h=new Event("click",{bubbles:d});f.indeterminate=s(o),r.call(f,s(o)?!1:o),f.dispatchEvent(h)}},[b,o,d]),t.createElement("input",C({type:"checkbox","aria-hidden":!0,defaultChecked:s(o)?!1:o},u,{tabIndex:-1,ref:a,style:{...e.style,...i,position:"absolute",pointerEvents:"none",opacity:0,margin:0}}))};function s(e){return e==="indeterminate"}function P(e){return s(e)?"indeterminate":e?"checked":"unchecked"}const R=H,F=X,G=t.forwardRef(({className:e,...n},o)=>k.jsx(R,{ref:o,className:g("peer h-4 w-4 shrink-0 rounded-sm border border-primary ring-offset-background focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-ring focus-visible:ring-offset-2 disabled:cursor-not-allowed disabled:opacity-50 data-[state=checked]:bg-primary data-[state=checked]:text-primary-foreground",e),...n,children:k.jsx(F,{className:g("flex items-center justify-center text-current"),children:k.jsx(O,{className:"h-4 w-4"})})}));G.displayName=R.displayName;export{G as C};
