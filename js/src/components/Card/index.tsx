import { TCardData } from '@/types'
import React, { FC } from 'react'
import defaultImage from '@/assets/images/defaultImage.jpg'
import { useAtomValue } from 'jotai'
import { selectedDataAtom } from '@/pages/atom';

export const Card: FC<TCardData> = ({
	postId,
	link,
	title,
	image,
	left,
	top,
}) => {
	const selectedData = useAtomValue(selectedDataAtom);
	const isShow = !!selectedData.postId && selectedData.postId === postId;
	return (
		<a href={link} target="_blank">
			<div className={`sh-map-icon-card ${isShow ? 'sh-showed' : ''
				}`} style={{
					top: `calc(${top}% - 1.5rem)`,
					left: `${left}%`,
				}}>
				<img decoding="async" src={image || defaultImage} className='sh-w-full' />
				<h4>{title}</h4>
			</div>
		</a>
	)
}
